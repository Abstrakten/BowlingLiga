package svin.bowlingliga;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;

import svin.bowlingliga.Models.Player;

public class profile_activity extends AppCompatActivity {

    Player thisPlayer = new Player(9999,"JohnDoeFuckedUp",9999);
    // Variables
    Button captureProfilePic, saveChanges;
    ImageView profileConfig;
    private static final int CAMERA_PIC_REQUEST = 1337;
    EditText FirstNameEdit, LastNameEdit;
    String fname;
    Bitmap ProfileImage, currentProfilePic;
    SharedPreferences ProfileData;
    int i = 0;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile_activity);

        setTitle("Profil");

        // General views used
        captureProfilePic = (Button) findViewById(R.id.newProfilePic);
        profileConfig = (ImageView) findViewById(R.id.ProfilePic);
        saveChanges = (Button) findViewById(R.id.saveChanges);
        FirstNameEdit = (EditText) findViewById(R.id.FirstNameEdit);
        LastNameEdit = (EditText) findViewById(R.id.LastNameEdit);

        // File for saving profile data
        ProfileData = getSharedPreferences(fname, AppCompatActivity.MODE_PRIVATE);

        // Setup on click listeners
        captureProfilePic.setOnClickListener(new captureProfilePicClicker());
        //saveChanges.setOnClickListener(new sharedPrefs());
        //loadChanges.setOnClickListener(new sharedPrefs());

        // Setup views for profile text
        String FirstNameLoad = ProfileData.getString("FirstNamePut", "");
        String LastNameLoad = ProfileData.getString("LastNamePut", "");
        FirstNameEdit.setText(FirstNameLoad);
        LastNameEdit.setText(LastNameLoad);

        // Load profile pic

        if (i == 0) {
            loadProfilePic();
            i++;
        }
        if (ProfileImage != currentProfilePic)
            loadProfilePic();


            Button ReadStatsButton = (Button) findViewById(R.id.ReadStatsButton);
            ReadStatsButton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent(profile_activity.this, ReadStatsActivity.class);
                    intent.putExtra("id", thisPlayer.getId());
                    startActivity(intent);
                }


       });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_profile_menu, menu);
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

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == CAMERA_PIC_REQUEST) {
            ProfileImage = (Bitmap) data.getExtras().get("data");
            profileConfig.setImageBitmap(ProfileImage);
        }
    }

    public void internalProfileStorage() {
        // Save image to internal storage

        // Load image from view
        profileConfig.setDrawingCacheEnabled(true);
        Bitmap currentProfilePic = profileConfig.getDrawingCache();

        // Setting up fileroot
        File root = getFilesDir();
        File imageDir = new File(root + "/images");
        imageDir.mkdirs();  // Create folder

        // Logging - check where the image is saved
        Log.d("Output_path_", imageDir.getAbsolutePath());

        // Image specifications
        String profileImageFile = "profileImage";
        File profileImage = new File(imageDir, profileImageFile);

        try {
            FileOutputStream outputStream = new FileOutputStream(profileImage);
            currentProfilePic.compress(Bitmap.CompressFormat.JPEG, 100, outputStream);
            outputStream.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void loadProfilePic() {
        String filename = "profileImage";
        // Calling the fileroot previously set-up
        File root = getFilesDir();
        File imageDir = new File(root + "/images");

        try {
            File loadProfileImage = new File(imageDir, filename);
            Bitmap profileImage = BitmapFactory.decodeStream(new FileInputStream(loadProfileImage));
            ImageView image = (ImageView) findViewById(R.id.ProfilePic);
            image.setImageBitmap(profileImage);
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }
    }

    class captureProfilePicClicker implements Button.OnClickListener {

        @Override
        public void onClick(View picture) {

            Intent PictureTaker = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
            startActivityForResult(PictureTaker, CAMERA_PIC_REQUEST);
        }
    }

    public void saveProfile(View v) {
        String FirstNameText = FirstNameEdit.getText().toString();
        String LastNameText = LastNameEdit.getText().toString();
        SharedPreferences.Editor ProfileEditor = ProfileData.edit();
        ProfileEditor.putString("FirstNamePut", FirstNameText);
        ProfileEditor.putString("LastNamePut", LastNameText);
        ProfileEditor.apply();

        internalProfileStorage();
        Toast.makeText(this, "Changes Saved!", Toast.LENGTH_SHORT).show();
    }
}