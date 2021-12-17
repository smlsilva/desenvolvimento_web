function getData() {

    try {
        const response = fetch("https://www.balldontlie.io/api/v1/teams", { method: 'get' })

        response.then(obj => {
            obj.json()
                .then(datasInObject => {
                    const values = Array.from(datasInObject.data)

                    let names = []
                    let city  = []

                    values.forEach(e => {
                        names.push(e.name)
                        city.push(e.city)
                    })

                    show(names, city)
                })
        })
    } catch (error) {
        console.error(error)
    }
}

function show(...datas) {

    let component = ''
    let city = ''

    for (let name of datas[0]) {
        for (let city of datas[1]){
            city += city
        }
        component += `<li>${name}:${city}</li>`
    }

    const div = document.createElement('div')

    div.innerHTML = component
    return document.body.appendChild(div)
}

getData()