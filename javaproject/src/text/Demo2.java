package text;
import java.util.Scanner;
public class Demo2 {
	
	public static void main(String[] args) {
		
		Scanner input = new Scanner(System.in);
		System.out.println("Please enter rdious:");//��ʾ�û�����
		int rdious = input.nextInt();
		
		double pi = 3.1415926535;//�����뾶��ֵ
		double circle = rdious * rdious * pi;//����Բ�����
		System.out.println("The circle area is :" + circle);//������
		
	}

}
