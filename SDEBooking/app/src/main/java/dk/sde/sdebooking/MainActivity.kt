package dk.sde.sdebooking

import android.Manifest
import android.annotation.TargetApi
import android.app.Activity
import android.content.Context
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.drawable.AnimationDrawable
import android.os.Build
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.support.v4.app.ActivityCompat
import android.support.v4.content.ContextCompat
import android.view.View
import android.widget.EditText
import android.widget.Toast
import dk.sde.sdebooking.network.authenticator
import android.os.Looper
import android.support.annotation.RequiresApi
import android.support.v4.content.ContextCompat.startActivity
import android.util.Log
import dk.sde.sdebooking.userdata.data
import org.json.JSONObject


class MainActivity : AppCompatActivity() {
    private val data = data()

    @RequiresApi(Build.VERSION_CODES.LOLLIPOP)
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        if (data.isLoggedIn(this@MainActivity)){
            val intent = Intent(this@MainActivity,HomeActivity::class.java)
            startActivity(this@MainActivity,intent, null)

        }

    }




    @TargetApi(Build.VERSION_CODES.N)
    fun onClick(v: View){
        val emailInput = findViewById<EditText>(R.id.emailInput)
        val passwordInput = findViewById<EditText>(R.id.passwordInput)
        val auth = authenticator()
        val thread = object : Thread() {
            override fun run() {
                try {
                    auth.login(emailInput.text.toString(),passwordInput.text.toString())
                    Handler(Looper.getMainLooper()).post {  responseActions(auth.getResponseData(),v.context) }
                } catch (e: Exception) {
                    Handler(Looper.getMainLooper()).post {  }
                }

            }
        }

        thread.start()

    }
    fun responseActions(temporalResponse: JSONObject,context: Context){
        if(temporalResponse.getInt("code") == 200) {
           val user = temporalResponse.getJSONArray("user").getJSONObject(0)
            data.saveData(user,context)
            val intent = Intent(context,HomeActivity::class.java)
            startActivity(context,intent, null)

        }else{
            Log.d("UI thread",temporalResponse.getString("error"))
            val text = temporalResponse.getString("error")
            val duration = Toast.LENGTH_SHORT

            val toast = Toast.makeText(context, text, duration)
            toast.show()
        }

    }
}


