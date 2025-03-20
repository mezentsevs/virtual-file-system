export function blurAfterSubmit(event, id) {
    if (!(event instanceof SubmitEvent)) { return; }

    const $el = document.getElementById(id);

    if ($el) { $el.blur(); }
}
