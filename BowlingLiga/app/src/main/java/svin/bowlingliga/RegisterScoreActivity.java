package svin.bowlingliga;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.NumberPicker;
import android.widget.Spinner;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import svin.bowlingliga.ListAdapter.PlayerListAdapter;
import svin.bowlingliga.Models.Player;


public class RegisterScoreActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_score);

        setTitle("Indberet Kamp");

        NumberPicker numPickLeft = (NumberPicker)findViewById(R.id.LeftTeamScore);
        numPickLeft.setMinValue(1);
        numPickLeft.setMaxValue(20);
        numPickLeft.setWrapSelectorWheel(false);
        numPickLeft.setValue(0);

        NumberPicker numPickRight = (NumberPicker)findViewById(R.id.RightTeamScore);
        numPickRight.setMinValue(1);
        numPickRight.setMaxValue(20);
        numPickRight.setWrapSelectorWheel(false);
        numPickRight.setValue(0);

        Spinner HomeFirst = (Spinner) findViewById(R.id.HomeFirstName);
        Spinner HomeSecond = (Spinner) findViewById(R.id.HomeSecondName);
        Spinner AwayFirst = (Spinner) findViewById(R.id.AwayFirstName);
        Spinner AwaySecond = (Spinner) findViewById(R.id.AwaySecondName);

        final String URL = "http://beer.mokote.dk/resources/api/getLeaderboard.php";

        JsonArrayRequest req = new JsonArrayRequest(URL, new Response.Listener<JSONArray> () {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    List<Player> playerList = new ArrayList<>();

                    for(int i = 0; i < response.length(); i++){

                        JSONObject jObj = new JSONObject(response.getString(i));

                        Player p = new Player(
                                jObj.getInt("id"),
                                jObj.getString("username"),
                                jObj.getInt("rating"));

                        playerList.add(p);
                    }

                    Spinner HomeFirst = (Spinner) findViewById(R.id.HomeFirstName);
                    Spinner HomeSecond = (Spinner) findViewById(R.id.HomeSecondName);
                    Spinner AwayFirst = (Spinner) findViewById(R.id.AwayFirstName);
                    Spinner AwaySecond = (Spinner) findViewById(R.id.AwaySecondName);

                    PlayerListAdapter adapter = new PlayerListAdapter(RegisterScoreActivity.this, playerList);
                    HomeFirst.setAdapter(adapter);
                    HomeSecond.setAdapter(adapter);
                    AwayFirst.setAdapter(adapter);
                    AwaySecond.setAdapter(adapter);


                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                VolleyLog.e("Error: ", error.getMessage());
            }
        });

        // add the request object to the queue to be executed
        ApplicationController.getInstance().addToRequestQueue(req);


        Button SubmitButton = (Button) findViewById(R.id.submitButton);
        SubmitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                System.out.println(((Player) ((Spinner) findViewById(R.id.HomeFirstName)).getSelectedItem()).getPlayerName());
                String name1 = ((Player) ((Spinner) findViewById(R.id.HomeFirstName)).getSelectedItem()).getPlayerName();
                String name2 = ((Player) ((Spinner) findViewById(R.id.HomeSecondName)).getSelectedItem()).getPlayerName();
                String name3 = ((Player) ((Spinner) findViewById(R.id.AwayFirstName)).getSelectedItem()).getPlayerName();
                String name4 = ((Player) ((Spinner) findViewById(R.id.AwaySecondName)).getSelectedItem()).getPlayerName();

                if(((NumberPicker) findViewById(R.id.LeftTeamScore)).getValue() == ((NumberPicker) findViewById(R.id.RightTeamScore)).getValue()){
                    MessageBox("No Equal Scores allow", MsgType.ERROR);
                }
                else if(name1.equals(name2) ||
                        name1.equals(name3) ||
                        name1.equals(name4) ||
                        name2.equals(name3) ||
                        name2.equals(name4) ||
                        name3.equals(name4)) {
                    MessageBox("No Split Personalities", MsgType.ERROR);
                }
                else {

                    // TODO Input sanitation regMatch

                    StringRequest req = new StringRequest(Request.Method.POST, "http://beer.mokote.dk/resources/api/submitGame.php", new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            System.out.println(response);
                            if (!response.equals("Success!")) {
                                MessageBox(response, MsgType.ERROR);
                            } else {
                                MessageBox(response, MsgType.OK);
                            }
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
                            params.put("hasTeams", "FALSE");
                            params.put("username", getIntent().getStringExtra("username"));
                            params.put("password", getIntent().getStringExtra("password"));
                            params.put("player1", ((Player) ((Spinner) findViewById(R.id.HomeFirstName)).getSelectedItem()).getPlayerName());
                            params.put("player2", ((Player) ((Spinner) findViewById(R.id.HomeSecondName)).getSelectedItem()).getPlayerName());
                            params.put("player3", ((Player) ((Spinner) findViewById(R.id.AwayFirstName)).getSelectedItem()).getPlayerName());
                            params.put("player4", ((Player) ((Spinner) findViewById(R.id.AwaySecondName)).getSelectedItem()).getPlayerName());
                            params.put("score1", String.valueOf(((NumberPicker) findViewById(R.id.LeftTeamScore)).getValue()));
                            params.put("score2", String.valueOf(((NumberPicker) findViewById(R.id.RightTeamScore)).getValue()));

                            return params;
                        }
                    };

                    ApplicationController.getInstance().addToRequestQueue(req);
                }
            }
        });

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_register_score_activiten, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                finish();
                return true;

            default:
                return super.onOptionsItemSelected(item);
        }
    }

    private enum MsgType {
        OK, ERROR
    }

    private void MessageBox(String Msg, final MsgType type) {
        AlertDialog.Builder dlgAlert  = new AlertDialog.Builder(RegisterScoreActivity.this);
        dlgAlert.setMessage(Msg);
        if(type == MsgType.ERROR){
            dlgAlert.setTitle("Error Message...");
            dlgAlert.setPositiveButton("OK", null);
        }else{
            dlgAlert.setTitle("Success!");
            dlgAlert.setPositiveButton("Ok",
                new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        finish();
                    }
                }
            );
        }
        dlgAlert.setCancelable(true);
        dlgAlert.create().show();
    }
}
