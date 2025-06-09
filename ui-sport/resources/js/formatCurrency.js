export function formatCurrency(value, currency = 'VND', locale = 'en-US') {
    if (typeof value !== 'number') {
        value = parseFloat(value) || 0;
    }
    return value.toLocaleString(locale, { style: 'currency', currency });
}
