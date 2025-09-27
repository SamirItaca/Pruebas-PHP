window.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.mdc-text-field').forEach(el => {
      new mdc.textField.MDCTextField(el);
    });

    document.querySelectorAll('.mdc-button').forEach(el => {
      mdc.ripple.MDCRipple.attachTo(el);
    });
});