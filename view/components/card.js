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
        .titulo {
          font-size: 1.2em;
          font-weight: bold;
          margin-bottom: 12px;
        }
        .contenido {
          font-size: 1em;
        }
      </style>
      <div class="wrapper">
        <div class="titulo">
          <slot name="titulo"></slot>
        </div>
        <div class="contenido">
          <slot name="contenido"></slot>
          <slot></slot>
        </div>
      </div>
    `;
  }
}

// Registrar el custom element
customElements.define('mi-card', Card);
