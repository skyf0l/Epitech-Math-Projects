use std::env;
mod radiator;

fn display_help() -> () {
    println!("USAGE");
    println!("\t./306radiator n ir jr [i j]");
    println!("DESCRIPTION");
    println!("\tn\t\tsize of the room");
    println!("\t(ir, jr)\tcoordinates of the radiator");
    println!("\t(i, j)\t\tcoordinates of a point in the room");
}

fn main() -> () {
    // get arguments
    let args: Vec<String> = env::args().collect();

    if args.contains(&String::from("-h")) || args.contains(&String::from("--help")) {
        display_help();
    } else {
        // call radiator function
        match radiator::radiator(args) {
            Ok(_) => (),
            Err(e) => {
                // display error on stderr
                eprintln!("Error: {}", e);
                eprintln!("Try ./306radiator -h for more information");
                std::process::exit(84);
            }
        }
    }
}
