var mysql = require('mysql');
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "db1"
});   

con.connect(function (err) {
    if (err) throw err;
    console.log("Connected!");
}
    
);

// create a database and a table

con.query("CREATE DATABASE IF NOT EXISTS XXXX", function (err, result) {
    if (err) throw err;
    console.log("Database created");
});

con.query("USE XXXX", function (err, result) {
    if (err) throw err;
    console.log("Database selected");
});

var express = require('express');
const { retrieveSourceMap } = require('source-map-support');
var app = express();

//1
// end pint /tournaments fornisce l'elenco di tornei disponibili nel db, senza alcuna distinzione 
app.get('/tournaments', (req, res) => {
    res.json(db.Tornei); 
});

//2
//  end pint /tournaments/:id prende come valore nel URL un parametro impiegato nell'identificazione del torneo, API effettua i controlli e restituisce il torneo richiesto dal client
app.get('/tournaments/:id', (req, res) => {
    if (req.params.id) {
        res.json(db.Tornei.filter(t => t.id == req.params.id));

    }
});

//3
//API post con l'end poi /players dopo aver controllato l'esistenza del body, controlla l'esistenza di un campo nome ed email se presenti crea il giocatore, seno sestituisce il messaggio di errore, e il codice 400.
app.post('/players', (req, res) => {
    if (req.body && req.body.nome && req.body.email) {
        db.Giocatori.push({ id: db.Giocatori.length + 1, nome: req.body.nome, email: req.body.email });
        res.status(201).send('giocatore inserito con sucesso')
    } else {
        res.status(400).send('campi nome e cognome mancanti');
    }
});

//4
app.get('/winners', (req, res) => {
    var risultato = db.Tornei.filter(v => v.posizione == 1);
    var r=risultato.map((g) => {
        return { nomet: db.Tornei.find((t) => t.id == g.idtorneo), giocatore: db.Giocatori.find(e => e.id == g.idgiocatore) }
    });
    res.json(r);
});


app.listen(3000, console.log('server avviato'));