function getUrl(url){

    fetch(url, { method: 'get' })
        .then(datas => {
            datas.text()
            .then(resultado => {
                return resultado
            })
        })
        .catch(function (err) {
            console.error(err)
        })
}

module.exports.default(getUrl)