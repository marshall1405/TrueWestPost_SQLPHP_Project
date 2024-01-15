import java.io.FileWriter;
import java.io.IOException;
import java.util.Random;

public class CSVGenerator {

    public static void main(String[] args) {
    	String csvFilePath = "/Users/davidpavlicek03/Desktop/generated_data.csv";
        int numRows = 5000;

        try (FileWriter writer = new FileWriter(csvFilePath)) {
            for (int i = 1; i <= numRows; i++) {
                String articleName = "Article" + i;
                String isCollaboration = generateIsCollaboration();
                int readerCount = generateRandomValue(1, 3000);

                writer.append(String.format("%s,%s,%d\n", articleName, isCollaboration, readerCount));
            }

            System.out.println("CSV file generated successfully!");

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static String generateIsCollaboration() {
        Random random = new Random();
        return random.nextDouble() < 0.9 ? "0" : "1";
    }

    private static int generateRandomValue(int min, int max) {
        Random random = new Random();
        return random.nextInt(max - min + 1) + min;
    }
}
