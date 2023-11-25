<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Proforma</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container-facture {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .entete-facture {
            text-align: center;
            margin-bottom: 20px;
        }
        .societe-info {
            margin-bottom: 20px;
        }
        .details-facture {
            margin-bottom: 20px;
        }
        .tableau-facture {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .tableau-facture th, .tableau-facture td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .total-facture {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container-facture">
        <div class="entete-facture">
            <h2>Facture Proforma</h2>
        </div>

        <div class="societe-info">
            <p><strong>Nom de la société :</strong> Vente MOM</p>
            <p><strong>Adresse :</strong> Tsimbazaza</p>
            <p><strong>Téléphone :</strong> +261 34 56 647 14</p>
            <!-- Ajoutez d'autres informations sur la société au besoin -->
        </div>

        <div class="details-facture">
            <p><strong>Date de la facture :</strong> <?php echo date('Y-m-d'); ?></p>
        </div>

        <table class="tableau-facture">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($donne['nom']); $i++)
                    <tr>
                        <td>{{ $donne['nom'][$i] }}</td>
                        <td>{{ $donne['quantite'][$i] }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>    
    </div>
</body>
</html>
