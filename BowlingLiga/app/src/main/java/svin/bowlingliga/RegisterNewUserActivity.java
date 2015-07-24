package svin.bowlingliga;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;

import org.w3c.dom.Text;

import java.util.HashMap;
import java.util.Map;


public class RegisterNewUserActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_new_user);

        final String RegUserURL = "http://beer.mokote.dk/resources/api/registerUser.php";

        Button CreateUserButton = (Button) findViewById(R.id.CreateUserButton);
        CreateUserButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //regex for email ([a-z]|[A-Z]|[0-9]|\.)+@([a-z]|[A-Z]|[0-9]|\.)+\.([a-z]|[A-Z]|[0-9]|\.)+
                // TODO add more checks for valid names/pass/mail
                if (((EditText)findViewById(R.id.newPasswordText)).getText().toString().equals(((EditText) findViewById(R.id.newPasswordCheckText)).getText().toString())) {

                    StringRequest req = new StringRequest(Request.Method.POST, RegUserURL, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            // TODO add "wait while server derps" dialog box
                            // TODO log user in directly from here

                            Intent intent = new Intent();

                            intent.putExtra("name", ((EditText)findViewById(R.id.newNameText)).getText().toString());
                            intent.putExtra("pass", ((EditText)findViewById(R.id.newPasswordText)).getText().toString());

                            setResult(RESULT_OK,intent);

                            finish();
                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            VolleyLog.e("Error:" + error.getMessage());
                        }
                    }) {
                        @Override
                        protected Map<String, String> getParams() {
                            Map<String, String> params = new HashMap<String, String>();
                            params.put("username", ((EditText) findViewById(R.id.newNameText)).getText().toString());
                            params.put("password", ((EditText) findViewById(R.id.newPasswordText)).getText().toString());
                            params.put("email", ((EditText) findViewById(R.id.newEmailText)).getText().toString());

                            return params;
                        }
                    };

                    ApplicationController.getInstance().addToRequestQueue(req);

                } else {
                    AlertDialog.Builder dlgAlert = new AlertDialog.Builder(RegisterNewUserActivity.this);
                    dlgAlert.setMessage("Info was incorrent - Check spelling");
                    dlgAlert.setTitle("Error Message...");
                    dlgAlert.setPositiveButton("OK", null);
                    dlgAlert.setCancelable(true);
                    dlgAlert.create().show();
                }
            }
        });

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_register_new_user, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
