// src/pages/Produtos.jsx
import { useEffect, useState } from "react";

export default function Produtos() {
    const [produtos, setProdutos] = useState([]);

    useEffect(() => {
        fetch("http://SEU_DOMINIO/api/produtos.php")
            .then(res => res.json())
            .then(data => setProdutos(data));
    }, []);

    return (
        <div className="p-4">
            <h1 className="text-xl font-bold mb-4">Produtos</h1>
            <table className="w-full border">
                <thead>
                    <tr>
                        <th className="border p-2">Nome</th>
                        <th className="border p-2">Preço</th>
                        <th className="border p-2">Estoque</th>
                    </tr>
                </thead>
                <tbody>
                    {produtos.map((p) => (
                        <tr key={p.id}>
                            <td className="border p-2">{p.nome}</td>
                            <td className="border p-2">R$ {p.preco}</td>
                            <td className="border p-2">{p.estoque}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
