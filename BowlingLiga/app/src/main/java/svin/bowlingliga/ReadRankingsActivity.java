package svin.bowlingliga;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.List;

import svin.bowlingliga.ListAdapter.TeamListAdapter;
import svin.bowlingliga.Models.Team;


public class ReadRankingsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_read_rankings);

        ListView teamView = (ListView)findViewById(R.id.listView);

        Team team = new Team("Svinene", 5, 2, 1000);
        Team team1 = new Team("One-man army T", 0, 19999, -2);
        Team team2 = new Team("Nerdboosters", 15, 0, 2000);

        List<Team> teamList = new ArrayList<>();

        teamList.add(team);
        teamList.add(team1);
        teamList.add(team2);

        TeamListAdapter adapter = new TeamListAdapter(ReadRankingsActivity.this, teamList);
        teamView.setAdapter(adapter);

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_read_rankings, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
