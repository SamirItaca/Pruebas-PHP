document.getElementById("form-primo").addEventListener("submit", async function(e) {
    e.preventDefault(); // Evita el submit normal

    const form = e.target;
    const formData = new FormData(form);

    const respuesta = await fetch("http://localhost:8000/api/verificar-primo", {
        method: "POST",
        body: formData
    });

    const texto = await respuesta.text(); // el PHP devuelve HTML
    document.getElementById("resultado-primos").innerHTML = texto;
});

document.getElementById("form-primos-enteros").addEventListener("submit", async function(e) {
    e.preventDefault(); // Evita el submit normal

    const form = e.target;
    const formData = new FormData(form);

    const respuesta = await fetch("http://localhost:8000/api/verificar-primo-entre-dos", {
        method: "POST",
        body: formData
    });

    const texto = await respuesta.text(); // el PHP devuelve HTML
    document.getElementById("resultado-enteros").innerHTML = texto;
});