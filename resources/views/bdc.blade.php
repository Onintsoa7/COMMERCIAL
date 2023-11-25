<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Commande</title>
</head>
<body>
    <div style="margin: 20px;">
        <div style="display: flex; justify-content: center;">
            <h1><b>Bon de Commande</b></h1>
        </div>
        <div style="display: flex; justify-content: center;">
            <h3><b>Numero :</b>2023112001</h3>
        </div>
        <div style="display: flex; justify-content: center;">
            <h3><b>Date :</b>2023-11-20</h3>
        </div>

        <div style="margin-top: 20px;">
            <p><b>Fournisseur :</b> TELMA</p>
            <p><b>Contact :</b> 032 01 210 10</p>
            <p><b>Date de Livraison :</b> 2023-11-23</p>
            <p><b>Lieu de Livraison :</b> Andoram</p>
        </div>

        <div style="margin-top: 20px;">
            <table  border="2" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 50%;">Designation</th>
                        <th style="width: 10%;">Quantite</th>                           
                        <th style="width: 20%;">Prix Unitaire HT</th>
                        <th style="width: 20%;">Montant HT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Chemise</td>
                        <td><p style="float:right"> 1</p></td>
                        <td><p style="float:right"> 350,00</p></td>
                        <td><p style="float:right"> 7350,00</p></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Total TVA</th>
                        <th><p style="float:right"> 350,00</p></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Montant TTC</th>
                        <th><p style="float:right">  7350,00</p></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
        Montant en lettre : {{$data['montant_l']}}
        <br>
        <div style="margin-top: 20px; display: flex; justify-content: space-between;">
            <div><b>Client</b></div>
            <div style="float:right"><b>Fournisseur</b></div>
        </div>
    </div>
</body>
</html>
