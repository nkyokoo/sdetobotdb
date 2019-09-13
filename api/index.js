
const Hapi        = require('hapi');
const hapiAuthJWT = require('hapi-auth-jwt2');
const JWT         = require('jsonwebtoken');
const Boom = require('boom');
const routes = require("./routemanager");
const config = require("./util/config");




const validate = async function (decoded, request, h) {
    const pool = request.mysql.pool;
    const [rows,fields] = await pool.query('SELECT * FROM users WHERE id = ?', [decoded.id],
        function(err, results) {
            console.log(results);
        }
    );
    // do your checks to see if the person is valid
    if (rows.length === 0 && rows.disabled === 1) {
        return { isValid: false };
    }
    else {
        return { isValid : true };
    }
};
const init = async() => {

    const server = new Hapi.Server({ host: config.getHost(),port: config.getPort() });
    await server.register(hapiAuthJWT);
    server.auth.strategy('jwt', 'jwt',
        {   key: config.getSecret(),
            validate,
            verifyOptions: { algorithms: [ 'HS256' ] }
        });
    const clientOpts = {
        settings: `mysql://${config.getDBuser()}@${config.getDBHost()}/${config.getDB()}?dateStrings=date`,
        decorate: true
    };

    await server.register([
        {
            plugin: require('hapi-mysql2'),
            options: clientOpts
        },{
            plugin:require('susie'),
        },{
            plugin: require('hapi-rate-limit'),
            options: {
                enabled: true,
                userLimit: 200,
                userCache: {
                    segment: "user",
                    expiresIn: 60000
                }
            }
        }
    ]);

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