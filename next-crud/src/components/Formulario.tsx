import React from "react";
import Cliente from "../core/Cliente";
import Botao from "./Botao";
import Input from "./Input";

interface FormularioProps {
    cliente: Cliente
}

export default function Formulario(props: FormularioProps) {
    const id = props.cliente?.id
    const [nome, setNome] = React.useState(props.cliente?.nome ?? '')
    const [idade, setIdade] = React.useState(props.cliente?.idade ?? 0)

    return (
        <div>
            {id ? (
                <Input somenteLeitura texto="Código" valor={id} className="mb-4" />
            ) : false}
            <Input texto="Nome" valor={nome} valorMudou={setNome} className="mb-4" />
            <Input texto="Idade" tipo="number" valor={idade} valorMudou={setIdade} />
            <div className="flex justify-end mt-7">
                <Botao cor="blue" className="mr-2">
                    {id ? 'Alterar' : "Salvar"}
                </Botao>
                <Botao cor="gray">
                    Cancelar
                </Botao>
            </div>
        </div>
    )
}