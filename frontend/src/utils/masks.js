export const currency = {
    preProcess: val => val.replace(/[$,]/g, ''),
    postProcess: val => {
        if (!val) return ''

        const sub = 3 - (val.includes('.') ? val.length - val.indexOf('.') : 0)

        return Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
        }).format(val)
        .slice(0, sub ? -sub : undefined)
    }
};