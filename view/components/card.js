// js/miCard.js

class Card extends HTMLElement {
  constructor() {
    super();
    // Crear Shadow DOM para encapsular HTML y CSS
    const shadow = this.attachShadow({ mode: 'open' });

    shadow.innerHTML = `
      <style>
        .wrapper {
        margin-top: 40px;
        width: 420px;
        background-color: blanchedalmond;
        border: 2px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(15px);
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        color: #333;
        border-radius: 16px;
        padding: 20px 30px;
        }
        .wrapper h2 {
          margin-top: 0;
          font-size: 20px;
        }
        .wrapper p {
          color: #555;
        }
      </style>
      <div class="wrapper">
        <h2><slot name="titulo">Título por defecto</slot></h2>
        <p><slot name="contenido">Contenido por defecto</slot></p>
      </div>
    `;
  }
}

// Registrar el custom element
customElements.define('mi-card', Card);
