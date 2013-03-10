package com.climbuddy.techtest;

import java.io.File;
import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.mime.MultipartEntity;
import org.apache.http.entity.mime.content.FileBody;
import org.apache.http.entity.mime.content.StringBody;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import android.os.AsyncTask;
import android.os.Environment;
import android.content.Context;
import android.util.Log;

public class UploadVideo extends AsyncTask<Context, Void, Boolean> 
{
	private String pathToFile = "";
    private String username = "";
    private String climbID = "";
    private String rating = "";

    
    public UploadVideo(String pathtofile, String username, String climbID, String rating)
    {
    	//File test = Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_DOWNLOADS);
    	
    	this.pathToFile = pathtofile;
    	this.username = username;
    	this.climbID = climbID;
    	this.rating = rating;
    	
    }

	
	protected Boolean doInBackground(Context... context)
	{
		return this.doFileUpload(pathToFile,username,climbID,rating);
	}
	
	protected void onPostExecute(Boolean result) 
	{
        if(result)
        {
        	
        }
        else
        {
        	
        }
    }

	
	private Boolean doFileUpload(String pathToFile, String username, String climbID, String rating)
	{
		HttpEntity resEntity;
	    //File test = Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_DOWNLOADS);
	    //String pathToOurFile = test.getAbsolutePath() + "/test2.mp4";
        File file = new File(pathToFile);
	    String urlServer = "http://54.235.158.91/upload.php";
        try
        {
             HttpClient client = new DefaultHttpClient();
             HttpPost post = new HttpPost(urlServer);
             FileBody bin = new FileBody(file);
             MultipartEntity reqEntity = new MultipartEntity();
             reqEntity.addPart("uploadedfile", bin);
             reqEntity.addPart("username", new StringBody(username));
             reqEntity.addPart("climbID", new StringBody(climbID));
             reqEntity.addPart("rating", new StringBody(rating));
             post.setEntity(reqEntity);
             HttpResponse response = client.execute(post);
             resEntity = response.getEntity();
             final String response_str = EntityUtils.toString(resEntity);
            
             if (resEntity != null) 
             {
                 Log.i("RESPONSE",response_str);
             }
             if(response_str.lastIndexOf("false") != -1 || response_str == "")
             {
            	 //TODO Upload failed, respond accordingly
            	 //Toast.makeText(getApplicationContext(),"Your upload failed, please try again.", Toast.LENGTH_SHORT).show();
            	 Log.i("UploadFail","Upload failed try again");
            	 return Boolean.FALSE;
             }
        }
        catch (Exception ex)
        {
             Log.e("Debug", "error: " + ex.getMessage(), ex);
             return Boolean.FALSE;
        }
    	return Boolean.TRUE;
      }

}
