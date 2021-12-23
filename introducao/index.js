// TIPOS DE DADOS EM JAVASCRIPT

const numero = 2;
const string = 'TUDO BEM COM VOCÊ ?'
const boolean = true == 1 ? false : 'null'

//console.log(typeof(numero))
//console.log(typeof(string))
//console.log(typeof(boolean))

// ESTRUTURA DE DADOS

const valores = ['Samuel', 21, 'moreno']

// TIPOS DE ARRAYS
// number
// boolean
// misto
// string
// objeto

//console.log(typeof(valores))

// ESTRUTURA DE CONDIÇÃO

// WHILE
/*let x = 0
while(x <= 3){
    x += 1
    console.log(`Tenho ${x} anos`)
}

// FOR
for(let x = 1; x <= 3; x++){
    console.log(`\nEu tenho ${x} anos`)
}*/

// FOR in
const marcasDeCarros = ['honda', 'fiat', 'pegeout', 'ferrari']

/*for( i in marcasDeCarros){
    console.log('Indice ' + i + ' do elemento ' + marcasDeCarros[i])
    console.log(marcasDeCarros[i])
}

for(marca of marcasDeCarros){[
    console.log(marca)
]}*/

// ESTRUTURAS DE CONTROLE

// SE CONDIÇÃO FOR VERDADEIRA 
/*if(valor){
    console.log('Sim')
}else {
    console.log('Errado, TENTE DE NOVO')
}

const valor = 1
switch(valor){
    case 1:
        console.log(valor)
    case 2:
        console.log(valor)
    case 3:
        console.log(valor)
        
    default:
        console.log('ACABOU E NÃO É NENHUM!')
}*/

// TÉCNICAS

// DESTRUCTURING
const clientes = ['João', 30, 'Palio', 'Olhos Castanhos']
const [ nome,  ,  , caracte ] = clientes
//console.log(nome, caracte)

// HOISTING

// Não é boa prática
valor = 2
var valor
//console.log(valor)

// TRY CATCH

const dado = 2
try {
    //console.log(dado)
} catch (e) {
    //console.error(e)
}

// OBJETO

const carro = {
    'marca': 'fiat',
    'modelo': '34d',
    'cor': 'Branco'
}

const modelos = new Object()

Object.freeze(carro)

carro.marca = 'gol'
const [ marca, cor ] = [carro.marca, carro.cor]
//console.log(marca, cor)

// FUNÇÃO

function setIdade(idade = 'não existe'){
    console.log('A minha idade é ' + idade)
}

//setIdade()

// OPERADORES UNÁRIOS E TERNÁRIOS

var num1 = 1
//console.log(num += 1)
//console.log(num *= 2)
//console.log(num1 -= 2)
//console.log(num1 /= 4)
//console.log(num1 %= 9)

2 == 1 ? console.log(true) : console.log(false)