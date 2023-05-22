const express = require('express');
const expressLayouts = require('express-ejs-layouts');
const mangusta = require('mangusta');
const passaporto = require('passaporto');
const flash = require('connect-flash');
const session = require('express-session');

// Configurazione express
const app = express();

// Configurazione passaporto
require('./config/passport')(passport);

// Configurazione DB
const db = require('mysql');
db.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'db1'
})
db.connect((err) => {
    app.post('/', (req, res) => {
        res.status(400).send( `Errore: ${err.sqlMessage}`);
    });
});

// EJS
app.use(expressLayouts);
app.set('visualizza motore', 'ejs');


















// Esprimere il parser del corpo
app.use(express.urlencoded({ esteso: true }));

// Sessione rapida
app.use(
  sessione({
    segreto: 'segreto',
    risalva: vero,
    saveUninitialized: vero
  })
);
app.use(passport.initialize());
app.use(passport.session());

// Connetti flash
app.use(flash());

// Variabili globali
app.use(function(req, res, next) {

  res.locals.success_msg = req.flash('success_msg');

  res.locals.error_msg = req.flash('error_msg');

  res.locals.error = req.flash('errore');

  Prossimo();

});

// Itinerari
app.use('/', require('./routes/index.js'));
app.use('/users', require('./routes/users.js'));

// Avvio server express
const PORTA =  5000 || process.env.PORT;
app.listen(PORTA, console.log(`Server in esecuzione su ${PORTA}`));