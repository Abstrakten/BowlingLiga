package svin.bowlingliga;

import android.app.ActionBar;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;

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


public class ReadRankingsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_read_rankings);


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
                    ListView teamView = (ListView)findViewById(R.id.listView);
                    PlayerListAdapter adapter = new PlayerListAdapter(ReadRankingsActivity.this, playerList);
                    teamView.setAdapter(adapter);

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
        getMenuInflater().inflate(R.menu.menu_read_rankings, menu);
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
