#[path = "matrix.rs"]
mod matrix;

const H: f32 = 0.5;
const BASE: f32 = -300.0;

struct Radiator {
    n: i32,
    matrix: matrix::Matrix,
    gauss_vector: Vec<f32>,
}

fn generate_matrix(n: i32) -> matrix::Matrix {
    let mut matrix = matrix::generate_identity_matrix((n * n) as usize);

    // fill each submatrix
    for mut offset_y in 0..n - 2 {
        offset_y *= n;

        let mut y = 0;
        for i in offset_y + n + 1..offset_y + 2 * n - 1 {
            let points = [
                1 + y + offset_y,
                n + y + offset_y,
                n + y + 1 + offset_y,
                n + y + 2 + offset_y,
                2 * n + y + 1 + offset_y,
            ];

            let coefficients = [1, 1, -4, 1, 1];
            let mut coefficient_id = 0;

            for x in 0..(n * n) {
                if points.contains(&x) {
                    let value = (1.0 / (H * H)) * (coefficients[coefficient_id]) as f32;
                    matrix[i as usize][x as usize] = value;
                    coefficient_id += 1;
                }
            }
            y = y + 1;
        }
    }
    matrix
}

fn calculate_pivot(matrix: &matrix::Matrix, n: i32, j: i32) -> i32 {
    let mut y = j;
    for i in j..n * n {
        if matrix[i as usize][j as usize].abs() > matrix[y as usize][j as usize].abs() {
            y = i;
        }
    }
    y
}

fn generate_gauss_vector(matrix: &matrix::Matrix, n: i32, ir: i32, jr: i32) -> Vec<f32> {
    let mut tmp_matrix = matrix.clone();
    let mut gauss_vector = vec![0.0; (n * n) as usize];
    let mut tmp_vector = vec![0.0; (n * n) as usize];
    tmp_vector[(ir * n + jr) as usize] = BASE;

    for i in 0..n * n - 1 {
        let y = calculate_pivot(&tmp_matrix, n, i);
        tmp_matrix.swap(y as usize, i as usize);
        tmp_vector.swap(y as usize, i as usize);
        for k in i + 1..n * n {
            let m =
                (tmp_matrix[k as usize][i as usize] * -1.0) / tmp_matrix[i as usize][i as usize];
            let tmp = tmp_matrix[i as usize].clone();
            for (a, b) in tmp_matrix[k as usize].iter_mut().zip(tmp.iter()) {
                *a = *a + m * *b;
            }
            tmp_vector[k as usize] = tmp_vector[k as usize] + m * tmp_vector[i as usize];
        }
    }
    for i in (0..n * n).rev() {
        for k in i + 1..n * n {
            tmp_vector[i as usize] -= tmp_matrix[i as usize][k as usize] * gauss_vector[k as usize];
        }
        gauss_vector[i as usize] = tmp_vector[i as usize] / tmp_matrix[i as usize][i as usize]
    }
    return gauss_vector;
}

fn generate_radiator(n: i32, ir: i32, jr: i32) -> Result<Radiator, Box<dyn std::error::Error>> {
    // check args
    if n <= 2 {
        return Err("n must be a positive integer greater than 2".into());
    }
    if ir < 1 || ir > n - 2 {
        return Err("ir must be a positive integer between [1, N - 2]".into());
    }
    if jr < 1 || jr > n - 2 {
        return Err("jr must be a positive integer between [1, N - 2]".into());
    }

    // generate matrix
    let matrix = generate_matrix(n);
    let gauss_vector = generate_gauss_vector(&matrix, n, ir, jr);
    let radiator = Radiator {
        n,
        matrix,
        gauss_vector,
    };
    Ok(radiator)
}

fn display_radiator(matrix: &Radiator) {
    // display matrix
    for row in matrix.matrix.iter() {
        for col in row[0..row.len() - 1].iter() {
            print!("{}\t", col);
        }
        println!("{}", row[row.len() - 1]);
    }
    println!();

    // display gauss matrix
    for val in matrix.gauss_vector.iter() {
        println!("{:.1}", val + 0.001);
    }
}

fn display_radiator_point(
    matrix: &Radiator,
    i: i32,
    j: i32,
) -> Result<(), Box<dyn std::error::Error>> {
    // check args
    if i < 1 || i > matrix.n - 2 {
        return Err("i must be a positive integer between [1, N - 2]".into());
    }
    if j < 1 || j > matrix.n - 2 {
        return Err("j must be a positive integer between [1, N - 2]".into());
    }

    // display
    let mut res = (matrix.gauss_vector[(i * matrix.n + j) as usize] * 10.0).round() / 10.0;
    if res == -0.0 {
        res = 0.0;
    }
    println!("{:.1}", res);
    Ok(())
}

pub fn radiator(args: Vec<String>) -> Result<(), Box<dyn std::error::Error>> {
    if args.len() == 4 {
        let n = args[1].parse::<i32>()?;
        let ir = args[2].parse::<i32>()?;
        let jr = args[3].parse::<i32>()?;

        // generate matrix
        let matrix = generate_radiator(n, ir, jr)?;
        // display matrix
        display_radiator(&matrix);
    } else if args.len() == 6 {
        let n = args[1].parse::<i32>()?;
        let ir = args[2].parse::<i32>()?;
        let jr = args[3].parse::<i32>()?;
        let i = args[4].parse::<i32>()?;
        let j = args[5].parse::<i32>()?;

        // generate matrix
        let matrix = generate_radiator(n, ir, jr)?;
        // display matrix point
        display_radiator_point(&matrix, i, j)?;
    } else {
        // invalid number of arguments
        return Err("Invalid number of arguments".into());
    }
    Ok(())
}
