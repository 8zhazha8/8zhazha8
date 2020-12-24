package text;
import java.util.Scanner;
public class Demo3 {
			public static void main(String[] args) {
				Scanner input = new Scanner(System.in);
				System.out.println("Please enter your local :");
				
				int fahrenheit = input.nextInt();
				double degreeCentigrade = 5.0/9.0 * (fahrenheit - 32);
				
				System.out.println("Your local temperature is:" + degreeCentigrade );
				
			}
}
