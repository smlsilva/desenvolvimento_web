const express = require('express')
const app = express()
const datas = require('./db.json')

// Resource (ENTIDADE)
// Verbos HTTP
// GET, POST, PUT, DELETE

// http://localhost:3000/clients

app.use(express.json())

// END POINT
app.get('/clients/', function (req, res) {
    res.json(datas)
})

app.get('/clients/:id', function (req, res) {
    const { id } = req.params
    const client = datas.produtos[id].id == id ? datas.produtos[id] : undefined 

    if(!client) return res.status(204).json()  

    const dados = {
        'id': datas.produtos[id].id,
        'nome': datas.produtos[id].nome,
        'desc': datas.produtos[id].descricao,
        'preco': datas.produtos[id].preco
    }
     
    res.json([dados.nome, dados.desc, dados.preco])
})

app.post('/clients/', function (req, res) {
    
    const { nome, id } = req.body

    // Salvar
    console.log(nome)

    res.json({ nome, id })
})

app.put('/clients/:id', function (req, res) {

    const { id } = req.params
    const client = datas.produtos[id].id == id ? datas.produtos[id] : undefined 

    const { nome } = req.body

    const client1 = datas.produtos[id].nome = nome

    res.json(client1)
})

app.delete('/clients/:id', function (req, res) {

    const { id } = req.params
    const clientsFiltered = datas.produtos.filter(client => client.id != id)

    res.json(clientsFiltered)

})

app.listen(3000, () => {
    console.log('http://localhost:3000/')
})