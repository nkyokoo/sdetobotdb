
const Hapi        = require('hapi');
const hapiAuthJWT = require('hapi-auth-jwt2');
const JWT         = require('jsonwebtoken');
const Boom = require('boom');
const port        = process.env.PORT || 8000;
const routes = require("./routemanager");
const users = require("./apiusers/apiusercreation");

users.createToken();

const validate = async function (decoded, request, h) {



    // do your checks to see if the person is valid
    if (!people[decoded.id]) {
        return { isValid: false };
    }
    else {
        return { isValid : true };
    }
};

const init = async() => {

    const server = new Hapi.Server({ port: port });
    await server.register(hapiAuthJWT);
    server.auth.strategy('jwt', 'jwt',
        { key: users.getsecret(),
            validate,
            verifyOptions: { ignoreExpiration: true }
        });
    const clientOpts = {
        settings: 'mysql://root@localhost/sdebookingsystem',
        decorate: true
    };

    await server.register({
        plugin: require('hapi-mysql2'),
        options: clientOpts
    });
    server.events.on('response', function (request) {
        console.log(request.info.remoteAddress + ': ' + request.method.toUpperCase() + ' ' + request.path + ' --> ' + request.response.statusCode);
    });
    server.auth.default('jwt');

    server.route(routes);

    await server.start();
    return server;


};


init().then(server => {
    console.log('Server running at:', server.info.uri);
}).catch(err => {
    console.log(err);
});