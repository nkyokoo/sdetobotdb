package dk.sde.sdebooking.network

import android.os.Build
import android.support.annotation.RequiresApi
import android.util.Log
import java.io.*
import java.net.HttpURLConnection
import java.net.URL
import java.nio.charset.StandardCharsets
import org.json.JSONException
import org.json.JSONObject


var responsejson : JSONObject = JSONObject()

class authenticator {
    @RequiresApi(Build.VERSION_CODES.N)
    fun login(email: String, password: String) {
        val credentials = JSONObject()
        try {
            credentials.put("email", email)
            credentials.put("password", password)


        } catch (e: JSONException) {
            e.printStackTrace()
        }

        val serverURL: String = "http://172.16.5.145:8000/api/users/login"
        val url = URL(serverURL)
        val connection = url.openConnection() as HttpURLConnection
        connection.requestMethod = "POST"
        connection.connectTimeout = 300000
        connection.connectTimeout = 300000
        connection.doOutput = true

        val postData: ByteArray = credentials.toString().toByteArray(StandardCharsets.UTF_8)

        connection.setRequestProperty("charset", "utf-8")
        connection.setRequestProperty("Content-length", postData.size.toString())
        connection.setRequestProperty("Content-Type", "application/json")

        try {
            val outputStream: DataOutputStream = DataOutputStream(connection.outputStream)
            outputStream.write(postData)
            outputStream.flush()
        } catch (exception: Exception) {

        }

            val reader: BufferedReader = BufferedReader(InputStreamReader(connection.inputStream))
            val output: String = reader.readLine()
            Log.d("InputStream", output)
            responsejson = JSONObject(output)

    }

    fun getResponseData() : JSONObject{
        val returningData = responsejson;
        return returningData

    }
}
