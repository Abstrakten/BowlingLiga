package svin.bowlingliga;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.CursorAdapter;
import android.widget.ListView;
import android.widget.NumberPicker;
import android.widget.Spinner;

import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonArrayRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import svin.bowlingliga.ListAdapter.PlayerListAdapter;
import svin.bowlingliga.Models.Player;


public class RegisterScoreActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_score);

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
}
