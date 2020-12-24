package text;
import java.util.Scanner;
public class Demo2 {
	
	public static void main(String[] args) {
		
		Scanner input = new Scanner(System.in);
		System.out.println("Please enter rdious:");//提示用户输入
		int rdious = input.nextInt();
		
		double pi = 3.1415926535;//声明半径的值
		double circle = rdious * rdious * pi;//计算圆的面积
		System.out.println("The circle area is :" + circle);//输出结果
		
	}

}
