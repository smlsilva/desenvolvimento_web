function getData() {

    try {
        const response = fetch("https://www.balldontlie.io/api/v1/teams", { method: 'get' })

        response.then(obj => {
            obj.json()
                .then(datasInObject => {
                    const values = Array.from(datasInObject.data)

                    let names = []
                    values.forEach(e => {
                        names.push(e.name)
                    })

                    show(names)
                })
        })
    } catch (error) {
        console.error(error)
    }
}

function show(datas) {

    let names = ''
    let city  = ''

    for (let data of datas) {

        names += `<li>${data}</li>`
    }

    const div = document.createElement('div')
    div.innerHTML = names
    return document.body.appendChild(div)
}

getData()