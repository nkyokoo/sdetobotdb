const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});
const fs = require('fs')
const JWT = require("jsonwebtoken")

let rawdata = fs.readFileSync('config.json');
let config = JSON.parse(rawdata);

const secret = config.secret;

const people = {
    1: {
        id: 1,
        name: 'Anthony Valid User'
    }
};


module.exports = {

    createToken: function (){
        rl.on('line', (input) => {

            if (input === "createToken") {
                const token = JWT.sign(people[1], secret);
                console.log(token)
            } else {
            }
        });
    },
    getsecret: function () {

        let rawdata = fs.readFileSync('config.json');
        let config = JSON.parse(rawdata);

        const secret = config.secret;
        return secret
    }
}