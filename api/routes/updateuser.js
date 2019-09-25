const cryptoFuncs = require("../backend/cryptoFuncs")

module.exports = {
    method: 'PATCH',
    path: '/api/user/updatepassword',
    config: {auth: 'jwt'},
    handler: async (request, h) => {
        const pool = request.mysql.pool

        if (request.payload) {
            const [rows, fields] = await pool.query('select * from users WHERE id = ?', [request.payload.id]);
            let decrypted;
            try {
                decrypted = cryptoFuncs.decrypt(rows[0].password)
                if (decrypted === request.payload.currentpassword) {
                    const hashed_password = cryptoFuncs.encrypt(request.payload.newpassword)
                    await pool.query('UPDATE users SET password = ? WHERE id = ?', [hashed_password, request.payload.id]);
                    return h.response({code: 200, message: "changed"}).code(200)


                } else {
                    return h.response({code: 400, error: "din nuværende adgangskode er ikke korrekt."}).code(200)
                }
            } catch (e) {
                console.log(e)
                return e
            }
        } else {
            return h.response({code: 400, error: "this is empty!"}).code(200)
        }
    }
}

