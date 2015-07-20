package svin.bowlingliga;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.NumberPicker;


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
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_register_score_activiten, menu);
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