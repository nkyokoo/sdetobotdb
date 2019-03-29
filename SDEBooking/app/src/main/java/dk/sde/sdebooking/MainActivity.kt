package dk.sde.sdebooking

import android.Manifest
import android.annotation.TargetApi
import android.content.pm.PackageManager
import android.os.Build
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.support.v4.app.ActivityCompat
import android.support.v4.content.ContextCompat
import android.view.View
import android.widget.EditText
import dk.sde.sdebooking.network.authenticator


class MainActivity : AppCompatActivity() {
//    val viewGroup = (this.findViewById<View>(android.R.id.content) as ViewGroup).getChildAt(0) as ViewGroup
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        //     val animDrawable = viewGroup.background as AnimationDrawable
        //animDrawable.setEnterFadeDuration(10)
       // animDrawable.setExitFadeDuration(5000)
        //animDrawable.start()


    }




    @TargetApi(Build.VERSION_CODES.N)
    fun onClick(v: View){

        val emailInput = findViewById<EditText>(R.id.emailInput)
        val passwordInput = findViewById<EditText>(R.id.passwordInput)
        val auth = authenticator()
        val thread = object : Thread() {
            override fun run() {
                auth.login(emailInput.text.toString(),passwordInput.text.toString(), v.context)
            }
        }
        thread.start()

    }
}


