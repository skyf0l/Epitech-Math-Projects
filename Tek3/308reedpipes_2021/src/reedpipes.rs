#[path = "spline.rs"]
mod spline;

use self::spline::Spline;
use crate::reedpipes::spline::{compute_spline, generate_new_points};

fn display_result(spline: &Spline, new_points: &Vec<(f32, f32)>) -> () {
    // display spline vector
    println!(
        "vector result: [{}]",
        spline
            .vector
            .iter()
            .map(|x| {
                let s = format!("{:.1}", x);
                if s == "-0.0" {
                    "0.0".to_string()
                } else {
                    s
                }
            })
            .collect::<Vec<String>>()
            .join(", ")
    );

    // display spline points
    for point in new_points {
        println!("abscissa: {:.1} cm\tradius: {:.1} cm", point.0, point.1);
    }
}

pub fn reedpipes(args: Vec<String>) -> Result<(), Box<dyn std::error::Error>> {
    if args.len() == 7 {
        // get arguments
        let r0 = args[1].parse::<f32>()?;
        let r5 = args[2].parse::<f32>()?;
        let r10 = args[3].parse::<f32>()?;
        let r15 = args[4].parse::<f32>()?;
        let r20 = args[5].parse::<f32>()?;
        let n = args[6].parse::<i32>()?;

        // check arguments
        if r0 <= 0.0 {
            return Err("r0 must be a positive non-zero float".into());
        }
        if r5 <= 0.0 {
            return Err("r5 must be a positive non-zero float".into());
        }
        if r10 <= 0.0 {
            return Err("r10 must be a positive non-zero float".into());
        }
        if r15 <= 0.0 {
            return Err("r15 must be a positive non-zero float".into());
        }
        if r20 <= 0.0 {
            return Err("r20 must be a positive non-zero float".into());
        }
        if n <= 0 {
            return Err("n must be a positive non-zero integer".into());
        }

        // compute splines
        let base_points = vec![(0.0, r0), (5.0, r5), (10.0, r10), (15.0, r15), (20.0, r20)];
        let spline = compute_spline(base_points);
        let new_points = generate_new_points(&spline, n);

        // display result
        display_result(&spline, &new_points);

        Ok(())
    } else {
        // invalid number of arguments
        Err("Invalid number of arguments".into())
    }
}
