interface BotaoProps {
    //cor?: 'green' | 'blue' | 'gray'
    className?: string
    children: any
    cor?: any
    onClick?: () => void    
}

export default function Botao(props: BotaoProps){

    return (
        <button onClick={props.onClick} className={`
            bg-gradient-to-r from-${props.cor}-400 to-${props.cor}-700
            text-white p-4 rounded-md
            ${props.className}
        `}>
            {props.children}
        </button>
    )
}