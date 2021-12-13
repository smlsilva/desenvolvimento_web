function getContent() {
    try {
        // const url = "http://localhost:4567/"
        const response = fetch("http://127.0.0.1:4567")
        console.log(response)
    } catch (err) {
        console.log('Errou')
    }
}
getContent()
