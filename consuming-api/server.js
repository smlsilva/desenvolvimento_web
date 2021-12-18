const express = require('express')
const app = express()
const cors = require('cors')
const axios = require('axios')

app.use(cors)

app.get('/', async (req, res) => {

    /*
    try {
        const { data } = await axios('https://jsonplaceholder.typicode.com/users')
        return res.json(data)
    } catch (error) {
        console.error(error)
    }*/

    // Criando uma API no back-end
    
    return res.json(
        
        { 
          name: 'Samuel',
          idade: 21
    },
        { name: 'Matheus'}
    )
})

const server = app.listen(8000, () => {
    const port = server.address().port

    console.log(`http://localhost:${port}`)
})