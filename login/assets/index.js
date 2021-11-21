function getData() {
    const inputUser = $('#user')
    const inputPass = $('#senha')
    const inputCheck = $('#check')

    let dados = new Array([inputUser, inputPass, inputCheck])

    console.log(dados[0][0].val()) // [[inputs..]]
    console.log(dados[0][1].val())
    console.log(dados[0][2].val())
}

$('button').on('click', function (e) {
    e.preventDefault()
    getData()
})