<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ticket Zoofari #{{ $order->id }}</title>
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        margin: 20px;
        color: #333;
    }

    header {
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #34A853;
        padding-bottom: 10px;
    }

    header img {
        width: 120px;
        margin-bottom: 10px;
    }

    h1 {
        color: #34A853;
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #34A853;
        color: white;
    }

    .footer {
        margin-top: 40px;
        font-size: 0.9rem;
        text-align: center;
        color: #777;
    }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('images/icones/zoofari.png') }}" alt="Zoofari Logo" />
        <h1>Ticket Zoofari</h1>
        <p>Commande #{{ $order->id }}</p>
        <p>Date de commande : {{ $order->created_at->format('d/m/Y') }}</p>
    </header>

    <table>
        <thead>
            <tr>
                <th>Type de ticket</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Date de visite</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->tickets as $orderTicket)
            <tr>
                <td>{{ $orderTicket->ticket->type ?? 'N/A' }}</td>
                <td>{{ $orderTicket->quantity }}</td>
                <td>{{ number_format($orderTicket->price, 2, ',', ' ') }} DHS</td>
                <<td>
                    {{ $orderTicket->visit_date ? \Carbon\Carbon::parse($orderTicket->visit_date)->format('d/m/Y') : 'N/A' }}
                    </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Merci de votre visite chez Zoofari !</p>
        <p>Ce Ticket est non remboursable, Tout changement ne doit s'effectuer que dans le guichet!</p>
        <p>Adresse: 123 Rue Safari, Marrakech | Contact: +212 6 12 34 56 78</p>
    </div>
</body>

</html>