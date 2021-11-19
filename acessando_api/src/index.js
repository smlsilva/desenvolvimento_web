function getData() {
    const url = "https://www.balldontlie.io/api/v1/teams"
    fetch(url, { method: 'get' })
        .then(dados => {
            dados.json()
                .then(function dados(array) {
                    const div = document.createElement('div')

                    for (let i = 0; i < array.data.length; i++) {
                        const th = document.createElement(`th${i}`)

                        const td1 = document.createElement(`td${i}`)
                        td1.innerHTML = array.data[i].city

                        const td2 = document.createElement(`td${i}`)
                        td2.innerHTML = array.data[i].abbreviation

                        const td3 = document.createElement(`td${i}`)
                        td3.innerHTML = array.data[i].conference

                        const td4 = document.createElement(`td${i}`)
                        td4.innerHTML = array.data[i].division

                        const td5 = document.createElement(`td${i}`)
                        td5.innerHTML = array.data[i].full_name

                        const td6 = document.createElement(`td${i}`)
                        td6.innerHTML = array.data[i].name

                        th.append(td1, td2, td3, td4, td5, td6)
                        div.append(th)
                        loadElement(div)
                    }
                })
        })
}

function createElements() {
    const div = document.createElement('div')
}

function loadElement(element) {
    const tag = document.body.appendChild(element)
    return tag
}

getData()