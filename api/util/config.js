
const fs = require('fs')

let rawData = fs.readFileSync('config.json');
let config = JSON.parse(rawData);

const secret = config.secret;




module.exports = {
    getSecret: function () {

        let rawdata = fs.readFileSync('config.json');
        let config = JSON.parse(rawdata);

        return config.secret
    },
    getHost: function () {

        let rawdata = fs.readFileSync('config.json');
        let config = JSON.parse(rawdata);

        return config.host
    },
    getPort: function () {

        let rawdata = fs.readFileSync('config.json');
        let config = JSON.parse(rawdata);

        return config.port
    },
    getDBHost: function () {

        let rawdata = fs.readFileSync('config.json');
        let config = JSON.parse(rawdata);

        return config.DBhost
    },
    getDBuser: function () {

        let rawdata = fs.readFileSync('config.json');
        let config = JSON.parse(rawdata);

        return config.DBuser
    },
    getDB: function () {

        let rawdata = fs.readFileSync('config.json');
        let config = JSON.parse(rawdata);

        return config.DB
    },
}