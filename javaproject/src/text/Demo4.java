package text;
import java.util.Scanner;
public class Demo4 {
		public static void main(String[] args) {
			System.out.println("Please enter a number");
			Scanner input = new Scanner(System.in);
			int num = input.nextInt();
			System.out.println("用户输入的数为：" + num);
			System.out.println("用户的十位数为" + num/10);
			System.out.println("用户的个位为" + num%10);
			
		}

}
