package text;

import java.util.Scanner;

public class Demo5 {
	public static void main(String[] args) {
		System.out.println("请输入一个数：");
		Scanner input = new Scanner(System.in);
		int num = input.nextInt();
		if(num % 2 == 1) {
			System.out.println((num+1));
		}
		if(num % 2 == 0) {
			System.out.println(num);
		}
	}

}
