package text;
import java.util.Scanner;
public class Demo4 {
		public static void main(String[] args) {
			System.out.println("Please enter a number");
			Scanner input = new Scanner(System.in);
			int num = input.nextInt();
			System.out.println("�û��������Ϊ��" + num);
			System.out.println("�û���ʮλ��Ϊ" + num/10);
			System.out.println("�û��ĸ�λΪ" + num%10);
			
		}

}
