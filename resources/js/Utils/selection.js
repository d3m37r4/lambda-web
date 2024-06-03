export function selectAll(items, selected, toggle) {
    if (toggle) {
        selected.value = items.map(item => item.id);
    } else {
        selected.value = [];
    }
}
