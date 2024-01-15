import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.sql.*;
import java.util.ArrayList;
import java.util.Random;

public class JavaDataGenerator {	
	public static void main(String args[]) {
		
		try {
			// Loads the class "oracle.jdbc.driver.OracleDriver" into the memory
			Class.forName("oracle.jdbc.driver.OracleDriver");

			// Connection details
			String database = "xxxxxxxx";
			String user = "xxxxxxxx";
			String pass = "xxxxxxxx";
			
			String housePath = "xxxxxxxx";
			String accountPath = "xxxxxxxx";
			String creatorPath = "xxxxxxxx";
			String articlePath = "xxxxxxxx";
			String opinionPath = "xxxxxxxx";
			
			// Establish a connection to the database
			Connection con = DriverManager.getConnection(database, user, pass);
			Statement stmt = con.createStatement();
			
			String line = "";
			
			String houseInsertQuery = "INSERT INTO Houses(HouseName) VALUES (?)";
			String accountInsertQuery = "INSERT INTO Accounts(AccountName, Email, Age, HouseID, HouseRoleID) VALUES (?,?,?,?,?)";
			String creatorInsertQuery = "INSERT INTO Creators(AccountID, FanCount, MonthlyReaderCount) VALUES (?,?,?)";
			String collaborationsInsertQuery = "INSERT INTO Collaborations(Creator1,Creator2) VALUES (?,?)";
			String articleInsertQuery = "INSERT INTO Articles(ArticleName, IsCollaboration, Author, Collaboration, ReaderCount) VALUES (?,?,?,?,?)";
			String opinionInsertQuery = "INSERT INTO Opinions VALUES (?,?,?,?)";
			
			Random random_method = new Random();
			
			BufferedReader br = null;
			
			//INSERTING HOUSES
			
			try {
				PreparedStatement housePstmt = con.prepareStatement(houseInsertQuery);
				con.setAutoCommit(false);
				
				try {
					br = new BufferedReader(new FileReader(housePath));
					
					while((line = br.readLine()) != null) {
						String[] values = line.split(",");
						housePstmt.setString(1,values[0]);
						housePstmt.addBatch();
					}
				} catch (FileNotFoundException e) {
					e.printStackTrace();
				}catch (IOException e) {
					e.printStackTrace();
				}
				
				int[] result = housePstmt.executeBatch();
				System.out.println("The number of House rows inserted: " + result.length);
				con.commit();
				housePstmt.close();
			} catch (Exception e) {
				e.printStackTrace();
				con.rollback();
			}
			
			//SAVING HOUSEID
			ArrayList<Integer> houseIDArray = new ArrayList<>();
			ResultSet houseIDQuery = stmt.executeQuery("SELECT HouseID FROM Houses");
			while(houseIDQuery.next()) {
				int houseID = houseIDQuery.getInt("HouseID");
				houseIDArray.add(houseID);
			}
			
			
			
			//INSERTING HOUSEROLES
			String houseRoleInsertQuery = "INSERT INTO HouseRoles(HouseRoleName, Tasks) VALUES (?,?)";
			String[] founder = {"Founder", "Founded the house and is completely control"};
			String[] coFounder = {"Co-Founder", "Co-Founded the house and has the same permissions as the founder"};
			String[] mainCreator = {"Main Creator", "The third highest role after Founder and Co-Founder, can vote in every house election"};
			String[] creator = {"Creator", "The fourth highest role, votes in some House elections"};
			String[] reader = {"Reader", "Basic Role without any permissions"};
			String[][] houseRoles = {founder, coFounder, mainCreator, creator, reader};
			
			
			try {
				PreparedStatement houseRolePstmt = con.prepareStatement(houseRoleInsertQuery);
				con.setAutoCommit(false);
				for(int i = 0; i < 5; i++) {
					houseRolePstmt.setString(1, houseRoles[i][0]);
					houseRolePstmt.setString(2, houseRoles[i][1]);
					houseRolePstmt.addBatch();
				}
				int[] result = houseRolePstmt.executeBatch();
				System.out.println("The number of HouseRole rows inserted: " + result.length);
				con.commit();
				houseRolePstmt.close();
			}catch(Exception e) {
				e.printStackTrace();
				con.rollback();
			}
			
			
			//SAVING HOUSEROLEID
			ArrayList<Integer> houseRoleIDArray = new ArrayList<>();
			ResultSet houseRoleIDQuery = stmt.executeQuery("SELECT HouseRoleID FROM HouseRoles");
			while(houseRoleIDQuery.next()){
				int houseRoleID = houseRoleIDQuery.getInt("HouseRoleID");
				houseRoleIDArray.add(houseRoleID);
			}
			
			
			//INSERTING ACCOUNTS
			try {
				PreparedStatement accountPstmt = con.prepareStatement(accountInsertQuery);
				con.setAutoCommit(false);
				
				try {
					br = new BufferedReader(new FileReader(accountPath));
					
					while((line = br.readLine()) != null) {
						String[] values = line.split(",");
						accountPstmt.setString(1,values[0]);
						accountPstmt.setString(2, values[1]);
						accountPstmt.setInt(3, Integer.valueOf(values[2]));
						accountPstmt.setInt(4, houseIDArray.get(random_method.nextInt(houseIDArray.size())));
						accountPstmt.setInt(5, houseRoleIDArray.get(random_method.nextInt(houseRoleIDArray.size())));
						accountPstmt.addBatch();
					}
				} catch (FileNotFoundException e) {
					e.printStackTrace();
				}catch (IOException e) {
					e.printStackTrace();
				}
				
				int[] result = accountPstmt.executeBatch();
				System.out.println("The number of Account rows inserted: " + result.length);
				con.commit();
				accountPstmt.close();
			} catch (Exception e) {
				e.printStackTrace();
				con.rollback();
			}
			
			//SAVING ACCOUNTID
			ArrayList<Integer> accountIDArray = new ArrayList<>();
			ResultSet accountIDQuery = stmt.executeQuery("SELECT AccountID FROM Accounts");
			while(accountIDQuery.next()){
				int accountID = accountIDQuery.getInt("AccountID");
				accountIDArray.add(accountID);
			}
			
			
			ArrayList<Integer> usedAccountID = new ArrayList<>();
			
			//INSERTING CREATORS
			try {
				PreparedStatement creatorPstmt = con.prepareStatement(creatorInsertQuery);
				con.setAutoCommit(false);
				
				try {
					br = new BufferedReader(new FileReader(creatorPath));
					
					while((line = br.readLine()) != null) {
						String[] values = line.split(",");
						int random = random_method.nextInt(accountIDArray.size());
						while(usedAccountID.contains(random)) {
							random = random_method.nextInt(accountIDArray.size());
						}
						creatorPstmt.setInt(1, accountIDArray.get(random));
						creatorPstmt.setInt(2, Integer.valueOf(values[0]));
						creatorPstmt.setInt(3, Integer.valueOf(values[1]));
						usedAccountID.add(random);
						creatorPstmt.addBatch();
					}
				} catch (FileNotFoundException e) {
					e.printStackTrace();
				}catch (IOException e) {
					e.printStackTrace();
				}
				
				int[] result = creatorPstmt.executeBatch();
				System.out.println("The number of Creator rows inserted: " + result.length);
				con.commit();
				creatorPstmt.close();
			} catch (Exception e) {
				e.printStackTrace();
				con.rollback();
			}
			
			//SAVING CREATORID
			ArrayList<Integer> creatorIDArray = new ArrayList<>();
			ResultSet creatorIDQuery = stmt.executeQuery("SELECT CreatorID FROM Creators");
			while(creatorIDQuery.next()){
				int creatorID = creatorIDQuery.getInt("CreatorID");
				creatorIDArray.add(creatorID);
			}
			
			
			ArrayList<Integer> usedCreatorID = new ArrayList<>();
			//INSERTING COLLABORATIONS
			try {
				PreparedStatement collaborationsPstmt = con.prepareStatement(collaborationsInsertQuery);
				con.setAutoCommit(false);
					for(int i = 0; i < 100; i++) {
						int creator1 = random_method.nextInt(creatorIDArray.size())+1;
						int creator2 = random_method.nextInt(creatorIDArray.size())+1;
						while(creator1 == creator2 || usedCreatorID.contains(creator1) || usedCreatorID.contains(creator2)) {
							creator1 = random_method.nextInt(creatorIDArray.size())+1;
							creator2 = random_method.nextInt(creatorIDArray.size())+1;
						}
						collaborationsPstmt.setInt(1, creator1);
						collaborationsPstmt.setInt(2, creator2);
						usedCreatorID.add(creator1);
						usedCreatorID.add(creator2);
						collaborationsPstmt.addBatch();
					}
				
				int[] result = collaborationsPstmt.executeBatch();
				System.out.println("The number of Collaboration rows inserted: " + result.length);
				con.commit();
				collaborationsPstmt.close();
			} catch (Exception e) {
				e.printStackTrace();
				con.rollback();
			}
			
			//SAVING COLLABORATIONID
			ArrayList<Integer> collaborationIDArray = new ArrayList<>();
			ResultSet collaborationIDQuery = stmt.executeQuery("SELECT CollaborationID FROM Collaborations");
			while(collaborationIDQuery.next()){
				int collaborationID = collaborationIDQuery.getInt("CollaborationID");
				collaborationIDArray.add(collaborationID);
			}
			
			//INSERTING ARTICLES
			try {
				PreparedStatement articlePstmt = con.prepareStatement(articleInsertQuery);
				con.setAutoCommit(false);
				
				try {
					br = new BufferedReader(new FileReader(articlePath));
					
					while((line = br.readLine()) != null) {
						String[] values = line.split(",");
						articlePstmt.setString(1, values[0]);
						articlePstmt.setInt(2, Integer.valueOf(values[1]));
						if("0".equals(values[1])) {
							int random = random_method.nextInt(creatorIDArray.size());
							articlePstmt.setInt(3, creatorIDArray.get(random));
							articlePstmt.setNull(4, Types.INTEGER);
						}else{
							int random = random_method.nextInt(collaborationIDArray.size());
							articlePstmt.setInt(4, collaborationIDArray.get(random));
							articlePstmt.setNull(3, Types.INTEGER);
						}
						articlePstmt.setInt(5, Integer.valueOf(values[2]));
						articlePstmt.addBatch();
					}
				} catch (FileNotFoundException e) {
					e.printStackTrace();
				}catch (IOException e) {
					e.printStackTrace();
				}
				
				int[] result = articlePstmt.executeBatch();
				System.out.println("The number of Article rows inserted: " + result.length);
				con.commit();
				articlePstmt.close();
			} catch (Exception e) {
				e.printStackTrace();
				con.rollback();
			}
			
			//SAVING ARTICLEID
			ArrayList<Integer> articleIDArray = new ArrayList<>();
			ResultSet articleIDQuery = stmt.executeQuery("SELECT ArticleID FROM Articles");
			while(articleIDQuery.next()){
				int articleID = articleIDQuery.getInt("ArticleID");
				articleIDArray.add(articleID);
			}
			
			
			ArrayList<int[]> opinionCreArtiArray = new ArrayList<>();
			
			//INSERTING OPINIONS
			try {
				PreparedStatement opinionPstmt = con.prepareStatement(opinionInsertQuery);
				con.setAutoCommit(false);
				
				try {
					br = new BufferedReader(new FileReader(opinionPath));
					
					while((line = br.readLine()) != null) {
						String[] values = line.split(",");
						int randCreator = random_method.nextInt(creatorIDArray.size());
						int randArticle = random_method.nextInt(articleIDArray.size());
						int[] combi = {creatorIDArray.get(randCreator), articleIDArray.get(randArticle)};
						
						while(opinionCreArtiArray.contains(combi)) {
							randCreator = random_method.nextInt(creatorIDArray.size());
							randArticle = random_method.nextInt(articleIDArray.size());
							combi[0] = creatorIDArray.get(randCreator);
							combi[1] = articleIDArray.get(randArticle);
						}
						
						opinionCreArtiArray.add(combi);
						
						opinionPstmt.setInt(1, creatorIDArray.get(randCreator));
						opinionPstmt.setInt(2, articleIDArray.get(randArticle));
						opinionPstmt.setInt(3, Integer.valueOf(values[0]));
						opinionPstmt.setInt(4, Integer.valueOf(values[1]));
						opinionPstmt.addBatch();
					}
				} catch (FileNotFoundException e) {
					e.printStackTrace();
				}catch (IOException e) {
					e.printStackTrace();
				}
				
				int[] result = opinionPstmt.executeBatch();
				System.out.println("The number of Opinion rows inserted: " + result.length);
				con.commit();
				opinionPstmt.close();
			} catch (Exception e) {
				e.printStackTrace();
				con.rollback();
			}
				
			
			
			ResultSet houseResult = stmt.executeQuery("SELECT COUNT(*) FROM Houses");
			if (houseResult.next()) {
				int count = houseResult.getInt(1);
				System.out.println("Number of House datasets: " + count);
			}
			
			ResultSet houseRoleResult = stmt.executeQuery("SELECT COUNT(*) FROM HouseRoles");
			if (houseRoleResult.next()) {
				int count = houseRoleResult.getInt(1);
				System.out.println("Number of HouseRole datasets: " + count);
			}
			
			ResultSet accountResult = stmt.executeQuery("SELECT COUNT(*) FROM Accounts");
			if (accountResult.next()) {
				int count = accountResult.getInt(1);
				System.out.println("Number of Account datasets: " + count);
			}
			
			ResultSet creatorResult = stmt.executeQuery("SELECT COUNT(*) FROM Creators");
			if (creatorResult.next()) {
				int count = creatorResult.getInt(1);
				System.out.println("Number of Creator datasets: " + count);
			}
			
			ResultSet collaborationResult = stmt.executeQuery("SELECT COUNT(*) FROM Collaborations");
			if (collaborationResult.next()) {
				int count = collaborationResult.getInt(1);
				System.out.println("Number of Collaboration datasets: " + count);
			}
			
			ResultSet articleResult = stmt.executeQuery("SELECT COUNT(*) FROM Articles");
			if (articleResult.next()) {
				int count = articleResult.getInt(1);
				System.out.println("Number of Article datasets: " + count);
			}
			
			ResultSet opinionResult = stmt.executeQuery("SELECT COUNT(*) FROM Opinions");
			if (opinionResult.next()) {
				int count = opinionResult.getInt(1);
				System.out.println("Number of Opinion datasets: " + count);
			}
		

			// Clean up connections
			opinionResult.close();
			articleResult.close();
			collaborationResult.close();
			houseResult.close();
			houseRoleResult.close();
			accountResult.close();
			stmt.close();
			con.close();
		} catch (Exception e) {
			System.err.println(e.toString());
		}
	}
}