const express = require('express')
const app = express()
const body = require('body-parser')
const port = 3000
app.use(body.urlencoded({ extended: true }))

app.get('/', (req, res) => {
  res.sendFile(__dirname + 'index.html')
})

app.post('/form', (req, res) => {
  res.send(req.body.value)
})

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})