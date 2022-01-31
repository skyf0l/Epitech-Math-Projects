use std::env;
mod reedpipes;

fn display_help(binary_name: &str) {
    println!("USAGE");
    println!("\t{} r0 r5 r10 r15 r20 n", binary_name);
    println!("\nDESCRIPTION");
    println!("\tr0\tradius (in cm) of pipe at the 0cm abscissa");
    println!("\tr5\tradius (in cm) of pipe at the 5cm abscissa");
    println!("\tr10\tradius (in cm) of pipe at the 10cm abscissa");
    println!("\tr15\tradius (in cm) of pipe at the 15cm abscissa");
    println!("\tr20\tradius (in cm) of pipe at the 20cm abscissa");
    println!("\tn\tnumber of points needed to display the radius");
}

fn main() -> () {
    // get arguments
    let args: Vec<String> = env::args().collect();
    let binary_name = args[0].clone();

    if args.contains(&String::from("-h")) || args.contains(&String::from("--help")) {
        display_help(&binary_name);
    } else {
        // call reedpipes function
        match reedpipes::reedpipes(args) {
            Ok(_) => (),
            Err(e) => {
                // display error on stderr
                eprintln!("Error: {}", e);
                eprintln!("Try {} -h for more information", &binary_name);
                std::process::exit(84);
            }
        }
    }
}
