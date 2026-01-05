document.addEventListener("DOMContentLoaded", async () => {

    const contenedor = document.getElementById("contenido");

    async function cargarProductos() {
        const respuesta = await fetch("/Healthy4Quality/api/productos.php");
        const datos = await respuesta.json();
    
        //  convertimos cada item del JSON en un objeto ProductoAdmin
        const productos = datos.map(p => new ProductoAdmin(
            p.id_producto,
            p.nombre,
            p.precio,
            p.descripcion
        ));
    
        let html = "<table border='1' cellpadding='6'>";
        html += "<tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Descripción</th></tr>";
    
        productos.forEach(p => {
            html += `
                <tr data-id="${p.id_producto}">
                    <td>${p.id_producto}</td>
                    <td>${p.nombre}</td>
                    <td>${p.precioFormateado()}</td>
                    <td>${p.descripcion}</td>
                `;
        });
    
        html += "</table>";
        contenedor.innerHTML = html;
    
        // devolvemos array de objetos ProductoAdmin
        return productos;
    }
    

    let productos = await cargarProductos();

    // EVENTO: crear producto
    document.getElementById("btnNuevo").onclick    = () => mostrarFormularioNuevo();

    // EVENTO: editar producto
    document.getElementById("btnEditar").onclick   = () => mostrarFormularioEditar(productos);

    // EVENTO: eliminar producto
    document.getElementById("btnEliminar").onclick = () => mostrarFormularioEliminar(productos);

    //EVENTO: ver pedidos
    document.getElementById("btnVerPedidos").onclick = () => mostrarPedidos();

    //EVENTO: ver coversión demoneda
    document.getElementById("btnMoneda").onclick = () => mostrarConversionMoneda();

    //EVENTO: ver logs
    document.getElementById("btnLogs").onclick = () => mostrarLogs();


});

function mostrarFormularioNuevo() {
    document.getElementById("contenido").innerHTML = `
        <h2>Crear nuevo producto</h2>
        <form id="formNuevo">
            <label>Nombre:</label><br>
            <input type="text" name="nombre" required><br><br>

            <label>Precio:</label><br>
            <input type="number" name="precio" step="0.01" required><br><br>

            <label>Descripción:</label><br>
            <textarea name="descripcion"></textarea><br><br>

            <button type="submit">Crear</button>
        </form>
    `;

    document.getElementById("formNuevo").onsubmit = async (e) => {
        e.preventDefault();

        const datos = new FormData(e.target);
        datos.append("accion", "crear");

        const respuesta = await fetch("/Healthy4Quality/api/productos.php", {
            method: "POST",
            body: datos
        });

        const result = await respuesta.json();

        if (result.ok) {
            alert("Producto creado correctamente");
            location.reload();
        } else {
            alert("Error: " + result.error);
        }
    };
}

function mostrarFormularioEditar(productos) {

    let opciones = "";
    productos.forEach(p => {
        opciones += `<option value="${p.id_producto}">${p.id_producto} - ${p.nombre}</option>`;
    });

    document.getElementById("contenido").innerHTML = `
        <h2>Editar producto</h2>
        <form id="formEditar">
            <label>Selecciona producto:</label><br>
            <select name="id_producto" id="selectProducto">
                ${opciones}
            </select><br><br>

            <label>Nombre:</label><br>
            <input type="text" name="nombre" id="editNombre" required><br><br>

            <label>Precio:</label><br>
            <input type="number" name="precio" id="editPrecio" step="0.01" required><br><br>

            <label>Descripción:</label><br>
            <textarea name="descripcion" id="editDescripcion"></textarea><br><br>

            <button type="submit">Guardar cambios</button>
        </form>
    `;

    const select      = document.getElementById("selectProducto");
    const inputNombre = document.getElementById("editNombre");
    const inputPrecio = document.getElementById("editPrecio");
    const inputDesc   = document.getElementById("editDescripcion");

    function rellenarFormulario() {
        const idSel = select.value;
        const prod  = productos.find(p => p.id_producto == idSel);
        if (prod) {
            inputNombre.value = prod.nombre;
            inputPrecio.value = prod.precio;
            inputDesc.value   = prod.descripcion ?? "";
        }
    }

    select.onchange = rellenarFormulario;
    rellenarFormulario();

    document.getElementById("formEditar").onsubmit = async (e) => {
        e.preventDefault();

        const datos = new FormData(e.target);
        datos.append("accion", "editar");

        const respuesta = await fetch("/Healthy4Quality/api/productos.php", {
            method: "POST",
            body: datos
        });

        const result = await respuesta.json();

        if (result.ok) {
            alert("Producto actualizado correctamente");
            location.reload();
        } else {
            alert("Error: " + result.error);
        }
    };
}

function mostrarFormularioEliminar(productos) {

    let opciones = "";
    productos.forEach(p => {
        opciones += `<option value="${p.id_producto}">${p.id_producto} - ${p.nombre}</option>`;
    });

    document.getElementById("contenido").innerHTML = `
        <h2>Eliminar producto</h2>
        <form id="formEliminar">
            <label>Selecciona producto:</label><br>
            <select name="id_producto">
                ${opciones}
            </select><br><br>

            <button type="submit">Eliminar</button>
        </form>
    `;

    document.getElementById("formEliminar").onsubmit = async (e) => {
        e.preventDefault();

        if (!confirm("¿Seguro que quieres eliminar este producto?")) return;

        const datos = new FormData(e.target);
        datos.append("accion", "eliminar");

        const respuesta = await fetch("/Healthy4Quality/api/productos.php", {
            method: "POST",
            body: datos
        });

        const result = await respuesta.json();

        if (result.ok) {
            alert("Producto eliminado correctamente");
            location.reload();
        } else {
            alert("Error: " + result.error);
        }
    };
}

async function mostrarPedidos() {
    const contenedor = document.getElementById("contenido");

    const respuesta = await fetch("/Healthy4Quality/api/pedidos.php");
    const datos = await respuesta.json();

    if (!Array.isArray(datos)) {
        contenedor.innerHTML = "Error cargando pedidos.";
        console.error(datos);
        return;
    }

    // Convertimos a objetos PedidoAdmin (si ya tienes la clase definida)
    let pedidos = datos.map(p => new PedidoAdmin(
        p.id_pedido,
        p.nombre_usuario,
        p.fecha,
        p.total,
        p.estado
    ));

    // Recuperar filtros guardados en localStorage (si los hubiera)
    const filtrosGuardados = JSON.parse(localStorage.getItem("filtrosPedidos") || "{}");

    const htmlFiltros = `
        <h2 class="h3 fw-bold mb-4">Pedidos</h2>

        <div id="filtros" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Usuario (contiene):</label>
                    <input type="text" id="filtroUsuario" class="form-control"
                        value="${filtrosGuardados.usuario || ""}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha desde:</label>
                    <input type="date" id="filtroDesde" class="form-control"
                        value="${filtrosGuardados.desde || ""}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha hasta:</label>
                    <input type="date" id="filtroHasta" class="form-control"
                        value="${filtrosGuardados.hasta || ""}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Total mínimo:</label>
                    <input type="number" step="0.01" id="filtroMin" class="form-control"
                        value="${filtrosGuardados.min || ""}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Total máximo:</label>
                    <input type="number" step="0.01" id="filtroMax" class="form-control"
                        value="${filtrosGuardados.max || ""}">
                </div>
            </div>

            <button id="btnAplicarFiltros" class="btn btn-success btn-sm mt-3">
                Aplicar filtros
            </button>
        </div>

        <div id="resumen" class="mb-3"></div>
        <div id="tablaPedidos"></div>
    `;

    contenedor.innerHTML = htmlFiltros;

    const inputUsuario = document.getElementById("filtroUsuario");
    const inputDesde   = document.getElementById("filtroDesde");
    const inputHasta   = document.getElementById("filtroHasta");
    const inputMin     = document.getElementById("filtroMin");
    const inputMax     = document.getElementById("filtroMax");
    const divTabla     = document.getElementById("tablaPedidos");
    const divResumen   = document.getElementById("resumen");

    function aplicarFiltrosYMostrar() {
        let filtrados = pedidos;

        const usuarioTxt = inputUsuario.value.toLowerCase();
        const desde      = inputDesde.value;
        const hasta      = inputHasta.value;
        const min        = parseFloat(inputMin.value);
        const max        = parseFloat(inputMax.value);

        if (usuarioTxt) {
            filtrados = filtrados.filter(p =>
                p.nombre_usuario.toLowerCase().includes(usuarioTxt)
            );
        }

        if (desde) {
            filtrados = filtrados.filter(p =>
                p.fecha >= desde
            );
        }

        if (hasta) {
            filtrados = filtrados.filter(p =>
                p.fecha <= hasta + " 23:59:59"
            );
        }

        if (!isNaN(min)) {
            filtrados = filtrados.filter(p => p.total >= min);
        }

        if (!isNaN(max)) {
            filtrados = filtrados.filter(p => p.total <= max);
        }

        // Guardar filtros en localStorage
        const filtrosActuales = {
            usuario: usuarioTxt,
            desde: desde,
            hasta: hasta,
            min: inputMin.value,
            max: inputMax.value
        };
        localStorage.setItem("filtrosPedidos", JSON.stringify(filtrosActuales));

        // Mostrar tabla con opciones de editar/eliminar
        let html = `
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        filtrados.forEach(p => {
            html += `
                <tr>
                    <td>${p.id_pedido}</td>
                    <td>${p.nombre_usuario}</td>
                    <td>${p.fecha}</td>
                    <td>${p.total.toFixed(2)} €</td>
                    <td>
                        <select class="form-select form-select-sm estado-select" data-id="${p.id_pedido}">
                            <option value="pendiente"   ${p.estado === "pendiente" ? "selected" : ""}>Pendiente</option>
                            <option value="preparando"  ${p.estado === "preparando" ? "selected" : ""}>Preparando</option>
                            <option value="enviado"     ${p.estado === "enviado" ? "selected" : ""}>Enviado</option>
                            <option value="entregado"   ${p.estado === "entregado" ? "selected" : ""}>Entregado</option>
                            <option value="cancelado"   ${p.estado === "cancelado" ? "selected" : ""}>Cancelado</option>
                        </select>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-outline-success btn-sm me-1 btn-guardar-estado" data-id="${p.id_pedido}">
                            Guardar estado
                        </button>
                        <button class="btn btn-outline-danger btn-sm btn-eliminar-pedido" data-id="${p.id_pedido}">
                            Eliminar
                        </button>
                    </td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>
            </div>
        `;

        divTabla.innerHTML = html;

        // Resumen con reduce
        const totalPedidos = filtrados.reduce((suma, p) => suma + p.total, 0);
        divResumen.innerHTML = `
            <p><strong>Nº pedidos:</strong> ${filtrados.length}</p>
            <p><strong>Total facturado (filtrado):</strong> ${totalPedidos.toFixed(2)} €</p>
        `;

        // Añadir eventos a botones Guardar estado
        document.querySelectorAll(".btn-guardar-estado").forEach(btn => {
            btn.onclick = async () => {
                const id = btn.dataset.id;
                const select = divTabla.querySelector(`.estado-select[data-id="${id}"]`);
                const nuevoEstado = select.value;

                const datos = new FormData();
                datos.append("accion", "actualizar");
                datos.append("id_pedido", id);
                datos.append("estado", nuevoEstado);

                const res = await fetch("/Healthy4Quality/api/pedidos.php", {
                    method: "POST",
                    body: datos
                });
                const r = await res.json();

                if (r.ok) {
                    alert("Estado actualizado correctamente");
                    mostrarPedidos(); // recargar lista
                } else {
                    alert("Error: " + r.error);
                }
            };
        });

        // Añadir eventos a botones Eliminar
        document.querySelectorAll(".btn-eliminar-pedido").forEach(btn => {
            btn.onclick = async () => {
                const id = btn.dataset.id;
                if (!confirm("¿Seguro que quieres eliminar el pedido " + id + "?")) return;

                const datos = new FormData();
                datos.append("accion", "eliminar");
                datos.append("id_pedido", id);

                const res = await fetch("/Healthy4Quality/api/pedidos.php", {
                    method: "POST",
                    body: datos
                });
                const r = await res.json();

                if (r.ok) {
                    alert("Pedido eliminado correctamente");
                    mostrarPedidos();
                } else {
                    alert("Error: " + r.error);
                }
            };
        });
    }

    document.getElementById("btnAplicarFiltros").onclick = aplicarFiltrosYMostrar;
    aplicarFiltrosYMostrar();
}


async function mostrarConversionMoneda() {
    const contenedor = document.getElementById("contenido");
    contenedor.innerHTML = "<p>Cargando datos de pedidos y monedas...</p>";

    try {
        // 1) Obtener pedidos para saber el total en EUR
        const resPedidos = await fetch("/Healthy4Quality/api/pedidos.php");
        const pedidos = await resPedidos.json();

        if (!Array.isArray(pedidos) || pedidos.length === 0) {
            contenedor.innerHTML = "<p>No hay pedidos para calcular conversión.</p>";
            return;
        }

        // total en EUR (asumiendo que tus precios son EUR)
        const totalEUR = pedidos.reduce((suma, p) => suma + parseFloat(p.total), 0);

        // 2) Obtener tipos de cambio desde nuestro endpoint PHP (que llama a la API externa)
        const resMoneda = await fetch("/Healthy4Quality/api/moneda.php");
        const datosMoneda = await resMoneda.json();

        if (datosMoneda.error) {
            contenedor.innerHTML = "<p>Error al obtener datos de moneda: " + datosMoneda.error + "</p>";
            return;
        }

        // freecurrencyapi devuelve algo tipo: { data: { USD: 1.08, GBP: 0.85, ... } }
        const rates = datosMoneda.data;

        const totalUSD = rates.USD ? totalEUR * rates.USD : null;
        const totalGBP = rates.GBP ? totalEUR * rates.GBP : null;
        const totalJPY = rates.JPY ? totalEUR * rates.JPY : null;

        let html = "<h2>Conversión de moneda</h2>";
        html += `<p><strong>Total facturado (EUR):</strong> ${totalEUR.toFixed(2)} €</p>`;

        html += "<ul>";
        if (totalUSD !== null) {
            html += `<li><strong>USD:</strong> ${totalUSD.toFixed(2)} $</li>`;
        }
        if (totalGBP !== null) {
            html += `<li><strong>GBP:</strong> ${totalGBP.toFixed(2)} £</li>`;
        }
        if (totalJPY !== null) {
            html += `<li><strong>JPY:</strong> ${totalJPY.toFixed(0)} ¥</li>`;
        }
        html += "</ul>";

        contenedor.innerHTML = html;

    } catch (e) {
        console.error(e);
        contenedor.innerHTML = "<p>Error al conectar con el servidor o la API externa.</p>";
    }
}

async function mostrarLogs() {
    const contenedor = document.getElementById("contenido");
    contenedor.innerHTML = "<p>Cargando logs...</p>";

    const res = await fetch("/Healthy4Quality/api/logs.php");
    const logs = await res.json();

    if (logs.error) {
        contenedor.innerHTML = "<p>No autorizado</p>";
        return;
    }

    let html = "<h2>Historial de acciones</h2>";

    html += "<table border='1' cellpadding='6'>";
    html += "<tr><th>Fecha</th><th>Usuario</th><th>Acción</th><th>Detalles</th></tr>";

    logs.forEach(log => {
        html += `
            <tr>
                <td>${log.fecha}</td>
                <td>${log.usuario ?? "Sistema"}</td>
                <td>${log.accion}</td>
                <td>${log.detalles ?? ""}</td>
            </tr>
        `;
    });

    html += "</table>";

    contenedor.innerHTML = html;
}

class ProductoAdmin {
    constructor(id_producto, nombre, precio, descripcion) {
        this.id_producto = id_producto;
        this.nombre = nombre;
        this.precio = parseFloat(precio);
        this.descripcion = descripcion ?? "";
    }

    // método de ejemplo: devolver el precio formateado
    precioFormateado() {
        return this.precio.toFixed(2) + " €";
    }
}

class PedidoAdmin {
    constructor(id_pedido, nombre_usuario, fecha, total, estado) {
        this.id_pedido = id_pedido;
        this.nombre_usuario = nombre_usuario;
        this.fecha = fecha;
        this.total = parseFloat(total);
        this.estado = estado;
    }

    // método de ejemplo: saber si está pendiente
    estaPendiente() {
        return this.estado === "pendiente";
    }
}






