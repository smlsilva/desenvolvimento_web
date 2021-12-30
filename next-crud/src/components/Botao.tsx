interface BotaoProps {
    //cor?: 'green' | 'blue' | 'gray'
    className?: string
    children: any
    cor?: any
}

export default function Botao(props: BotaoProps){

    return (
        <button className={`
            bg-gradient-to-r from-${props.cor}-400 to-${props.cor}-700
            text-white p-4 rounded-md
            ${props.className}
        `}>
            {props.children}
        </button>
    )
}