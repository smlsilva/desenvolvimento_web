async function getContent() {
    // Consumindo uma API do Back-end
    
    try {
        // const url = "http://localhost:4567/"
        const response = fetch('http://localhost:3000/categorias', { method: 'GET' })

        response.then(obj => {
            obj.json()
                .then(datas => {

                    var valores = datas

                    const dados = {
                        'id': [],
                        'nome': []
                    }

                    for (let i in Array.from(valores)) {
                        dados.id.push(valores[i].id)
                        dados.nome.push(valores[i].nome)
                    }

                    console.log(dados)
                    show(dados)
                })
        })
    } catch (err) {
        console.log(err)
    }
}

function show(datas) {

    let output = ''

    for (data in Array.from(datas.id)) {
        output += `<p>
            ${datas.id[data]} |
            ${datas.nome[data]}
            </p>`
    }

    document.querySelector('main').innerHTML = output
}


const categorias = document.querySelector('.categorias')
categorias.addEventListener('click', e => {
    e.preventDefault()

    getContent()
})